import {Component, OnInit} from '@angular/core';
import {AuthService} from "../../../services/auth/auth.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {

  constructor( private authService: AuthService, private router: Router) {
  }

  ngOnInit() {
  }

  logout() {
    console.log('logout');
    this.authService.logout().subscribe((res: any) => {
      // Store the access token in the localstorage
      localStorage.removeItem('access_token');
      this.router.navigate(['/login']);
    }, (err: any) => {
      // This error can be internal or invalid credentials
      // You need to customize this based on the error.status code
      // this.errors = true;
    });
  }
}
