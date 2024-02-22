import { Component, NgZone, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthencationService } from '../../../services/authencation.service';
import { AppComponent } from '../../../app.component';
 

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent implements OnInit{

  constructor(private router: Router, private auth: AuthencationService, private app: AppComponent,private ngZone: NgZone) { }
  ngOnInit(): void {
    this.ngZone.run(() => {
      // Cập nhật giá trị ở đây
      this.app.headerShow = false;
      this.app.footerShow = false;
    });
  }

  emailErr:string = "";
  passErr:string = "";

  onSubmit(form:NgForm) {
    const password = form.value.password;
    const email = form.value.email;
   
    this.auth.Login(password,email).subscribe((res:any)=>{
        localStorage.setItem('user', JSON.stringify(res));
        this.router.navigate(['/']);
      },
      err=>{
        this.emailErr = err.error.errors.email;
        this.passErr = err.error.errors.password;

      });
  }

}
