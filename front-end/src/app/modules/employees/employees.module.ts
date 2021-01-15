import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {EmployeesRoutingModule} from './employees-routing.module';
import {EditEmployeeComponent} from './edit/edit-employee.component';
import {ShowEmployeeComponent} from './show/show-employee.component';
import {CreateEmployeeComponent} from './create/create-employee.component';
import {IndexEmployeeComponent} from './index/index-employee.component';
import {EmployeesComponent} from './employees/employees.component';
import {LayoutModule} from '../layout/layout.module';
import {DataTablesModule} from 'angular-datatables';
import {HttpClientModule} from '@angular/common/http';
import {ComponentsModule} from '../components/components.module';


@NgModule({
  declarations: [EditEmployeeComponent, ShowEmployeeComponent, CreateEmployeeComponent, IndexEmployeeComponent, EmployeesComponent],
  imports: [
    CommonModule,
    EmployeesRoutingModule,
    LayoutModule,
    DataTablesModule,
    HttpClientModule,
    ComponentsModule
  ]
})
export class EmployeesModule {
}
