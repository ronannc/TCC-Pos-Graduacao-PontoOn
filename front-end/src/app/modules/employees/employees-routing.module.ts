import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {AuthGuardService} from '../../services/auth-guard/auth-guard.service';
import {IndexEmployeeComponent} from './index/index-employee.component';
import {CreateEmployeeComponent} from './create/create-employee.component';
import {EditEmployeeComponent} from './edit/edit-employee.component';
import {EmployeesComponent} from './employees/employees.component';
import {ShowEmployeeComponent} from './show/show-employee.component';


const routes: Routes = [
  {
    path: '', component: EmployeesComponent, canActivate: [AuthGuardService], children: [
      {path: '', component: IndexEmployeeComponent},
      {path: 'create', component: CreateEmployeeComponent},
      {path: 'edit', component: EditEmployeeComponent},
      {path: 'show', component: ShowEmployeeComponent},
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class EmployeesRoutingModule {
}
