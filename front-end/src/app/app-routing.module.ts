import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';


const routes: Routes = [
  {path: '', redirectTo: 'login', pathMatch: 'full'},
  {path: 'dashboards', loadChildren: () => import('./modules/dashboards/dashboards.module').then(m => m.DashboardsModule)},
  {path: 'login', loadChildren: () => import('./modules/auth/auth.module').then(m => m.AuthModule)},
  {path: 'employees', loadChildren: () => import('./modules/employees/employees.module').then(m => m.EmployeesModule)},
  {path: 'companies', loadChildren: () => import('./modules/companies/companies.module').then(m => m.CompaniesModule)},
  {path: 'syndicates', loadChildren: () => import('./modules/syndicates/syndicates.module').then(m => m.SyndicatesModule)},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
