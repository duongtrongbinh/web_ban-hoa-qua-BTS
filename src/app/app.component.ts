
  import { Component, OnInit } from '@angular/core';
import { AuthencationService } from './services/authencation.service';
import { Router } from '@angular/router';
import { ProductService } from './services/product.service';
  
  @Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrl: './app.component.css'
  })
  export class AppComponent implements OnInit{
    title = 'my-app';
    headerShow:boolean = true;
    footerShow:boolean = true;
    allDevice=true;
    constructor(private auth: AuthencationService, private router: Router,private product:ProductService){}
    ngOnInit() {
  
      // Thực hiện các tác vụ khởi tạo ở đây (nếu có)
      const myModal: HTMLElement | null= document.getElementById('myModal');
      const myInput: HTMLElement | null = document.getElementById('myInput');

      if (myModal !== null) {
        // myModal không null ở đây, bạn có thể sử dụng nó an toàn
        myModal.style.display = 'block';
        myModal.addEventListener('shown.bs.modal', () => {
          if (myInput !== null) {
              myInput.focus();

          }
      });
      } 
    }
  
    sumCart(){
      const x = this.product.getItems();
      return x.length;
    }
    logout(){
      this.auth.logout(this.allDevice).subscribe((res)=>{
        // console.log(res);
        localStorage.removeItem('user');

        const comf = confirm('Bạn đã đăng xuất thành công ');
        if(comf){
          this.router.navigate(['/']);

        }
  
        // Redirect
      }, (err) =>{
        console.log(err)
      })
    }
  

}



