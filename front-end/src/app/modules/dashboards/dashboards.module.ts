import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DashboardsRoutingModule } from './dashboards-routing.module';
import { DashboardsComponent } from './dashboards/dashboards.component';
import {LayoutModule} from "../layout/layout.module";
import {DataTablesModule} from "angular-datatables";
import {HttpClientModule} from "@angular/common/http";
import { V1Component } from './v1/v1.component';


@NgModule({
  declarations: [DashboardsComponent, V1Component],
  imports: [
    CommonModule,
    DashboardsRoutingModule,
    LayoutModule,
    DataTablesModule,
    HttpClientModule
  ]
})
export class DashboardsModule { }
