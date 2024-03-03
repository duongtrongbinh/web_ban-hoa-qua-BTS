
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
    quantity:number = 0;
    constructor(private auth: AuthencationService, private router: Router,private product:ProductService){}
    ngOnInit() {
      // số lượng sản phẩm có trong giỏ hàng
        const x = this.product.getItems();
        if(x.length >0){
            this.quantity = x.length;
        }else{
          this.quantity = 0;
        }
      } 
    
  

    logout(){
      this.auth.logout(this.allDevice).subscribe((res)=>{
        localStorage.removeItem('user');
        const comf = confirm('Bạn đã đăng xuất thành công ');
        if(comf){
          this.router.navigate(['/']);
        }
      }, (err) =>{
        console.log(err);
      })
    }
  

}



