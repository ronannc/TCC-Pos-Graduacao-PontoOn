import {Component, OnDestroy, OnInit} from '@angular/core';
import {AuthService} from "../../../services/auth/auth.service";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Router} from "@angular/router";

declare var $;

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit, OnDestroy {

  // Variables
  form: FormGroup;
  loading: boolean;
  errors: boolean;

  constructor(
    fb: FormBuilder,
    private router: Router,
    private authService: AuthService
  ) {
    this.form = fb.group({
      email: [
        '',
        [Validators.required, Validators.email]
      ],
      password: [
        '',
        Validators.required
      ]
    });
  }

  ngOnInit() {
    $('body').addClass('hold-transition login-page');
    $(() => {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  }

  ngOnDestroy(): void {
    $('body').removeClass('hold-transition login-page');
  }

  login(): void {
    this.loading = true;
    this.errors = false;
    this.authService.login(this.controls.email.value, this.controls.password.value)
      .subscribe((res: any) => {
        console.log(res, res.data.token);
        // Store the access token in the localstorage
        localStorage.setItem('access_token', res.data.token);
        this.loading = false;
        // Navigate to home page
        this.router.navigate(['/']);
      }, (err: any) => {
        // This error can be internal or invalid credentials
        // You need to customize this based on the error.status code
        this.loading = false;
        this.errors = true;
      });
  }

  /**
   * Getter for the form controls
   */
  get controls() {
    return this.form.controls;
  }
}
