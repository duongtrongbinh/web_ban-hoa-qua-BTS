import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class HomeService {

  constructor(private http: HttpClient) { }
  // url:string="http://127.0.0.1:8000/api/category";


  // getListBlog(): Observable<any>{
  //   return this.http.get<any>(this.url);
  // }
}
