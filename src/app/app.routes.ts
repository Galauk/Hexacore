import { Routes } from '@angular/router';
import { EquipeComponent } from './pages/equipe/equipe.component';
import { ProjetoComponent } from './pages/projeto/projeto.component';
import { MainComponent } from './pages/main/main.component';
import { ContatoComponent } from './pages/contato/contato.component';

export const routes: Routes = [
  {path:"",component:MainComponent },
  {path:"equipe",component:EquipeComponent },
  {path:"projeto",component:ProjetoComponent },
  {path:"contato",component:ContatoComponent },
  {path:'**',redirectTo:''}
];
