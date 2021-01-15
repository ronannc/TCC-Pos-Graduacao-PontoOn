import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class EnvService {

  URL = 'http://localhost:8000/api/';

  constructor() { }
}
