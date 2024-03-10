import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ConfigService {

  constructor() { }
  url:string = "https://dashboard.binhdt.id.vn/public";
  urlFont:string = "https://binhdt.id.vn";
}
