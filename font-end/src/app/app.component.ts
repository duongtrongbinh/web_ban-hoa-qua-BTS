
  import { Component, OnInit } from '@angular/core';
import { AuthencationService } from './services/authencation.service';
import { Router } from '@angular/router';
import { ProductService } from './services/product.service';
  
  @Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrl: './app.component.css',

  })
  export class AppComponent implements OnInit{
    title = 'my-app';
    headerShow:boolean = true;
    footerShow:boolean = true;

  
    constructor(private auth: AuthencationService, private router: Router,private product:ProductService){}
    ngOnInit() {


        
      } 
    



  

}



