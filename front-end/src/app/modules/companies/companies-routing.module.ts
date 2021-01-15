import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {AuthGuardService} from '../../services/auth-guard/auth-guard.service';
import {IndexCompaniesComponent} from './index/index-companies.component';
import {CreateCompaniesComponent} from './create/create-companies.component';
import {EditCompaniesComponent} from './edit/edit-companies.component';
import {ShowCompaniesComponent} from './show/show-companies.component';
import {CompaniesComponent} from './companies/companies.component';


const routes: Routes = [
  {
    path: '', component: CompaniesComponent, canActivate: [AuthGuardService], children: [
      {path: '', component: IndexCompaniesComponent},
      {path: 'create', component: CreateCompaniesComponent},
      {path: 'edit', component: EditCompaniesComponent},
      {path: 'show', component: ShowCompaniesComponent},
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CompaniesRoutingModule {
}
