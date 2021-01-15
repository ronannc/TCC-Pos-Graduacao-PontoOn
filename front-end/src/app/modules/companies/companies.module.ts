import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {CompaniesRoutingModule} from './companies-routing.module';
import {EditCompaniesComponent} from './edit/edit-companies.component';
import {ShowCompaniesComponent} from './show/show-companies.component';
import {CreateCompaniesComponent} from './create/create-companies.component';
import {IndexCompaniesComponent} from './index/index-companies.component';
import {CompaniesComponent} from './companies/companies.component';
import {LayoutModule} from '../layout/layout.module';
import {DataTablesModule} from 'angular-datatables';
import {HttpClientModule} from '@angular/common/http';
import {ComponentsModule} from '../components/components.module';


@NgModule({
  declarations: [EditCompaniesComponent, ShowCompaniesComponent, CreateCompaniesComponent, IndexCompaniesComponent, CompaniesComponent],
  imports: [
    CommonModule,
    CompaniesRoutingModule,
    LayoutModule,
    DataTablesModule,
    HttpClientModule,
    ComponentsModule
  ]
})
export class CompaniesModule {
}
