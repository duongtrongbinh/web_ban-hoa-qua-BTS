import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ConfigService {

  constructor() { }
  url:string = "http://127.0.0.1:8000";
  urlFont:string = "http://localhost:4200/";
}
