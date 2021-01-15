import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {AuthGuardService} from "../../services/auth-guard/auth-guard.service";
import {DashboardsComponent} from "./dashboards/dashboards.component";
import {V1Component} from "./v1/v1.component";


const routes: Routes = [
  {
    path: '', component: DashboardsComponent, canActivate: [ AuthGuardService ], children: [
      {path: '', component: V1Component}
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class DashboardsRoutingModule { }
