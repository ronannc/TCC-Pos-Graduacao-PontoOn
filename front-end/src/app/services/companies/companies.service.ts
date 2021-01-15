import { Injectable } from '@angular/core';
import {HttpClient, HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import {EnvService} from '../env/env.service';
import {Observable, throwError} from 'rxjs';
import {catchError, retry} from 'rxjs/operators';
import {Companies} from '../../models/companies';

@Injectable({
  providedIn: 'root'
})
export class CompaniesService {

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

  // Obtem todos os companys
  getCompanies(): Observable<Companies[]> {
    return this.httpClient.get<Companies[]>(this.env.URL + 'company', this.httpOptions)
      .pipe(
        retry(2),
        catchError(this.handleError));
  }

  // Obtem um company pelo id
  getCompaniesById(id: number): Observable<Companies> {
    return this.httpClient.get<Companies>(this.env.URL + 'company' + '/' + id)
      .pipe(
        retry(2),
        catchError(this.handleError)
      );
  }

  // salva um company
  saveCompanies(company: Companies): Observable<Companies> {
    return this.httpClient.post<Companies>(this.env.URL + 'company', JSON.stringify(company), this.httpOptions)
      .pipe(
        retry(2),
        catchError(this.handleError)
      );
  }

  // utualiza um company
  updateCompanies(company: Companies): Observable<Companies> {
    return this.httpClient.put<Companies>(this.env.URL + 'company' + '/' + company.id, JSON.stringify(company), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // deleta um company
  deleteCompanies(company: Companies) {
    return this.httpClient.delete<Companies>(this.env.URL + 'company' + '/' + company.id, this.httpOptions)
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
