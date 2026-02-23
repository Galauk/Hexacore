import 'zone.js/node';
import express from 'express';
import compression from 'compression';
import helmet from 'helmet';
import fs from 'node:fs';
import { join, dirname, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';
import { APP_BASE_HREF } from '@angular/common';
import { renderApplication } from '@angular/platform-server';
import bootstrap from './src/main.server'; // função async que retorna ApplicationRef

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

// Função que cria o app Express
export function app(): express.Express {
  const server = express();
  const browserDistFolder = resolve(__dirname, '../browser'); // pasta com build do frontend
  const indexHtml = join(browserDistFolder, 'index.html'); // HTML base do Angular

  server.use(helmet());
  server.use(compression());

  server.set('view engine', 'html');
  server.set('views', browserDistFolder);

  // Serve arquivos estáticos
  server.get('*.*', express.static(browserDistFolder, {
    maxAge: '1y'
  }));

  // Todas as rotas normais usam Angular SSR
  server.get('*', async (req, res) => {
    try {
      const document = fs.readFileSync(indexHtml, 'utf8');
      const html = await renderApplication(bootstrap, {
        document,
        url: req.url,
        platformProviders: [
          { provide: APP_BASE_HREF, useValue: req.baseUrl }
        ]
      });
      res.send(html);
    } catch (err) {
      console.error(err);
      res.status(500).send(String(err));
    }
  });

  return server;
}

// Função para iniciar o servidor
function run(): void {
  const port = process.env['PORT'] || 4000;
  const server = app();
  server.listen(port, () => {
    console.log(`Node Express server listening on http://localhost:${port}`);
  });
}

// Start
run();
