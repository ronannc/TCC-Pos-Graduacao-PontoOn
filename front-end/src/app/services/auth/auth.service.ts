import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {EnvService} from "../env/env.service";

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  // Variables
  apiUrl = 'http://localhost:8000/api';
  options: any;

  /**
   * @param http
   * @param env
   */
  constructor(
    private http: HttpClient,
    private env: EnvService
  ) {
    this.options = {
      headers: new HttpHeaders({
        Accept: 'application/json',
        'Content-Type': 'application/json'
      })
    };
  }

  /**
   * Get an access token
   * @param e The email address
   * @param p The password string
   */
  login(e: string, p: string) {
    return this.http.post(this.env.URL + 'login', {
      email: e,
      password: p,
    }, this.options);
  }

  /**
   * Revoke the authenticated user token
   */
  logout() {
    this.options = {
      headers: new HttpHeaders({
        Accept: 'application/json',
        'Content-Type': 'application/json',
        Authorization: 'Bearer ' + localStorage.getItem('access_token')
      })
    };
    return this.http.get(this.env.URL + 'logout', this.options);
  }
}
