import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { Observable } from 'rxjs';
import { HeaderTokenService } from './header-token.service';
import { ConfigService } from './config.service';

@Injectable({
  providedIn: 'root'
})
export class AuthencationService {

  constructor(private http: HttpClient, private router: Router, private headerToken: HeaderTokenService, private urlConfig: ConfigService) { }
  urlLogin:string=this.urlConfig.url + "/api/login";
  urlUser:string= this.urlConfig.url +"/api/user";
  urlLogout:string= this.urlConfig.url +"/api/logout";
  urlRegister:string= this.urlConfig.url +"/api/register";


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
