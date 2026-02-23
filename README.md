# Hexacore

Aplicação Angular (SSR) — versão atualizada

Este repositório contém uma aplicação frontend construída com **Angular 20.x** e suporte a Server-Side Rendering (SSR) através de um servidor **Express**. O projeto usa Bootstrap e FontAwesome para estilos e ícones.

Visão geral rápida
- **Entrada do app**: `src/main.ts` (cliente) e `src/main.server.ts` (servidor).
- **Servidor SSR**: `server.ts` (Express) — agora com `helmet` e `compression` adicionados para segurança e performance: [server.ts](server.ts#L1-L200).
- **Rotas**: rota principal definida em `src/app/app.routes.ts`: [src/app/app.routes.ts](src/app/app.routes.ts#L1-L20).
- **Dependências principais**: ver [package.json](package.json#L1-L60).

Estado atual
- O projeto está configurado para build com suporte a SSR/prerender (`npm run build:ssr`, `npm run serve:ssr`).
- A rota pública atual é a página `Principal` (roteada como `/`). Alguns componentes de página foram removidos por não estarem referenciados (se precisar restaurar algum, posso reverter).

Como executar localmente
1. Instale dependências
```bash
npm install
```
2. Rodar em desenvolvimento (client-only)
```bash
npm run start
# ou
ng serve
```
3. Build com SSR e servir o bundle Node (production)
```bash
npm run build:ssr
npm run serve:ssr
```
Observação: caso você use `npm run serve:ssr`, o servidor serve o build gerado em `dist/` — confirme o conteúdo de `dist/hexacore` após o build.

Testes
- Unit: `npm test` ou `ng test` (Karma/Jasmine está configurado por padrão).
- E2E: não há framework E2E incluído; recomendo `cypress` ou `playwright` para testes de integração.


Deploy
- Para servir como SSR em produção, use `npm run build:ssr` e execute `npm run serve:ssr` numa instância Node (Cloud Run, VPS, etc.).
- Para deploy estático (prerender), você pode usar Netlify ou outro provedor estático — o projeto já possui `netlify.toml` e `_redirects`.

Notas técnicas
- Engines especificadas: Node >= 18, npm >= 9 — ver [package.json](package.json#L1-L60).

