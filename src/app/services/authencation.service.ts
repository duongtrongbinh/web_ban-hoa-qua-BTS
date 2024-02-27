import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { Observable } from 'rxjs';
import { HeaderTokenService } from './header-token.service';

@Injectable({
  providedIn: 'root'
})
export class AuthencationService {

  constructor(private http: HttpClient, private router: Router, private headerToken: HeaderTokenService) { }
  urlLogin:string="http://127.0.0.1:8000/api/login";
  urlUser:string="http://127.0.0.1:8000/api/user";
  urlLogout:string="http://127.0.0.1:8000/api/logout";
  urlRegister:string="http://127.0.0.1:8000/api/register";


  Login(password:string, email:string): Observable<any>{
    return this.http.post<any>(this.urlLogin, {
      email:email,
      password:password
    });
  }
   // Logout
  logout(allDevice: boolean): Observable<any>{
    let headers = this.headerToken.headerToken();
    return this.http.post(this.urlLogout, {allDevice:allDevice}, {headers:headers});
  }
// User Info
  user() {
        let headers = this.headerToken.headerToken();
        return this.http.get(this.urlUser, {
          headers: headers,
        });
      }

 // Register
  register(name:string, email:string, password:string, password_confirmation:string){
    const data={
      name:name,
      email:email,
      password:password,
      password_confirmation:password_confirmation,
    }
    return this.http.post(this.urlRegister, data);
  }
}
