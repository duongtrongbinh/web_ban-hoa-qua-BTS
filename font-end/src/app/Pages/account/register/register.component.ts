import { Component, NgZone } from '@angular/core';
import { Router } from '@angular/router';
import { AuthencationService } from '../../../services/authencation.service';
import { AppComponent } from '../../../app.component';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrl: './register.component.css'
})
export class RegisterComponent {
  constructor(private router: Router, private auth: AuthencationService, private app: AppComponent,private ngZone: NgZone) { }
  ngOnInit(): void {
    // this.ngZone.run(() => {
    //   // Cập nhật giá trị ở đây
    //   this.app.headerShow = false;
    //   this.app.footerShow = false;
    // });
  }

  emailErr:string = "";
  passErr:string = "";
  nameErr:string = "";

  onSubmit(form:NgForm) {
    const name = form.value.name;
    const email = form.value.email;
    const password = form.value.password;
    const password_confirmation = form.value.password_confirmation;
   
    this.auth.register(name,email,password,password_confirmation).subscribe((res:any)=>{
      console.log(res);
        localStorage.setItem('user', JSON.stringify(res));
        const com = confirm('Ban da dnag ky tai khoan thanh cong. Vui long dang nhap.');
        if(com){
          this.router.navigate(['/account/login']);
        }
      },
      (err)=>{
        console.log(err);
        // this.nameErr = err.error.errors.name;
        // this.emailErr = err.error.errors.email;
        // this.passErr = err.error.errors.password;

      })
  }
}
