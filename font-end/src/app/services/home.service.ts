import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ConfigService } from './config.service';

@Injectable({
  providedIn: 'root'
})
export class HomeService {

  constructor(private http: HttpClient, private urlConfig: ConfigService) { }
  url:string= this.urlConfig.url +"/api/slides";



  // getListBlog(): Observable<any>{
  //   return this.http.get<any>(this.url);
  // }
  getSlides(): Observable<any>{
    return this.http.get<any>(this.url);
  }
}
