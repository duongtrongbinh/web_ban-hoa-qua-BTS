
  import { Component, OnInit } from '@angular/core';
import { AuthencationService } from './services/authencation.service';
import { Router } from '@angular/router';
  // import $ from 'jquery';
  // import 'select2';
  // import 'sweetalert';
  // import 'magnific-popup';
  // import 'perfect-scrollbar';
  // import swal from 'sweetalert';
  // import PerfectScrollbar from 'perfect-scrollbar';
  
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
    constructor(private auth: AuthencationService, private router: Router){}
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
    // ngAfterViewInit() {
    //   // const self = this as any;
  
  
    //   $(".js-select2").each(()=> {
    //     $(this).select2({
    //       minimumResultsForSearch: 20,
    //       dropdownParent: $(this).next(".dropDownSelect2"),
    //     });
    //   });
  
    //   $(".parallax100").parallax100();
  
    //   $(".js-addwish-b2").on("click", function (e: Event) {
    //     e.preventDefault();
    //   });
  
    //   $(".js-addwish-b2").each(()=> {
    //     var nameProduct = $(this).parent().parent().find(".js-name-b2").html();
    //     $(this).on("click", ()=> {
    //       swal(nameProduct, "is added to wishlist !", "success");
  
    //       $(this).addClass("js-addedwish-b2");
    //       $(this).off("click");
    //     });
    //   });
  
    //   $(".js-addwish-detail").each(()=> {
    //     var nameProduct = $(this)
    //       .parent()
    //       .parent()
    //       .parent()
    //       .find(".js-name-detail")
    //       .html();
  
    //     $(this).on("click", ()=> {
    //       swal(nameProduct, "is added to wishlist !", "success");
  
    //       $(this).addClass("js-addedwish-detail");
    //       $(this).off("click");
    //     });
    //   });
  
    //   /*---------------------------------------------*/
  
    //   $(".js-addcart-detail").each(()=> {
    //     var nameProduct = $(this)
    //       .parent()
    //       .parent()
    //       .parent()
    //       .parent()
    //       .find(".js-name-detail")
    //       .html();
    //     $(this).on("click", ()=> {
    //       swal(nameProduct, "is added to cart !", "success");
    //     });
    //   });
  
    //   $(".gallery-lb").each(()=> {
    //     // the containers for all your galleries
    //     $(this).magnificPopup({
    //       delegate: "a", // the selector for gallery item
    //       type: "image",
    //       gallery: {
    //         enabled: true,
    //       },
    //       mainClass: "mfp-fade",
    //     });
    //   });
  
    //   $(".js-pscroll").each(()=> {
    //     $(this).css("position", "relative");
    //     $(this).css("overflow", "hidden");
    //     const element: Element | null = document.querySelector(".js-pscroll");

    //     if (element) {
    //       const ps = new PerfectScrollbar(element, {
    //         wheelSpeed: 1,
    //         scrollingThreshold: 1000,
    //         wheelPropagation: false,
    //       });
    
    //       $(window).on("resize", function() {
    //         ps.update();
    //       });
    //     }
    //   });
   
    // }

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



