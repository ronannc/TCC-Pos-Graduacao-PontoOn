import {Injectable} from '@angular/core';
import {HttpClient, HttpErrorResponse, HttpHeaders} from "@angular/common/http";
import {Observable, throwError} from "rxjs";
import {Employee} from "../../models/employee";
import {catchError, retry} from 'rxjs/operators';
import {EnvService} from "../env/env.service";

@Injectable({
  providedIn: 'root'
})
export class EmployeeService {

  // Headers
  httpOptions = {
    headers: new HttpHeaders({
      Accept: 'application/json',
      'Content-Type': 'application/json',
      Authorization: 'Bearer ' + localStorage.getItem('access_token')
    })
  };

  // injetando o HttpClient
  constructor(private httpClient: HttpClient, private env: EnvService) {
  }

  // Obtem todos os employees
  getEmployees(): Observable<Employee[]> {
    return this.httpClient.get<Employee[]>(this.env.URL + 'employee', this.httpOptions)
      .pipe(
        retry(2),
        catchError(this.handleError));
  }

  // Obtem um employee pelo id
  getEmployeeById(id: number): Observable<Employee> {
    return this.httpClient.get<Employee>(this.env.URL + 'employee' + '/' + id)
      .pipe(
        retry(2),
        catchError(this.handleError)
      );
  }

  // salva um employee
  saveEmployee(employee: Employee): Observable<Employee> {
    return this.httpClient.post<Employee>(this.env.URL + 'employee', JSON.stringify(employee), this.httpOptions)
      .pipe(
        retry(2),
        catchError(this.handleError)
      );
  }

  // utualiza um employee
  updateEmployee(employee: Employee): Observable<Employee> {
    return this.httpClient.put<Employee>(this.env.URL + 'employee' + '/' + employee.id, JSON.stringify(employee), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // deleta um employee
  deleteEmployee(employee: Employee) {
    return this.httpClient.delete<Employee>(this.env.URL + 'employee' + '/' + employee.id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Manipulação de erros
  handleError(error: HttpErrorResponse) {
    let errorMessage = '';
    if (error.error instanceof ErrorEvent) {
      // Erro ocorreu no lado do client
      errorMessage = error.error.message;
    } else {
      // Erro ocorreu no lado do servidor
      errorMessage = `Código do erro: ${error.status}, ` + `menssagem: ${error.message}`;
    }
    console.log(errorMessage);
    return throwError(errorMessage);
  }
}
