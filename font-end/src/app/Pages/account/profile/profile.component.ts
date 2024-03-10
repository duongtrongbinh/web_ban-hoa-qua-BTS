import { Component, OnInit } from '@angular/core';
import { AuthencationService } from '../../../services/authencation.service';
import { Router } from '@angular/router';
import { ProductService } from '../../../services/product.service';
import { BillService } from '../../../services/bill.service';
import { DatePipe } from '@angular/common';
import { ConfigService } from '../../../services/config.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.css'
})
export class ProfileComponent implements OnInit{
  user:any;
  allDevice=true;
  user_id:number =0;
  orders:any;
  total:any;
  detail:any;
  url:string = this.urlConfig.url;

  constructor(private datePipe: DatePipe,private bill: BillService,private auth: AuthencationService, private router: Router,private product:ProductService,private urlConfig: ConfigService){}
  ngOnInit(): void {
    this.user_id = this.product.getUser();
    // console.log(this.user_id);
    const data1 = {
      'user_id': this.user_id
      };
    this.bill.orders(data1).subscribe(data=>{
      console.log(data);
      this.orders = data;
    }
    ,err=>{
      console.log(err);
    });


     }


     calculateTotalQuantity(order: { order_detail?: { quantity?: number }[] }): number {
      if (order && order.order_detail) {
        return order.order_detail.reduce((total, detail) => total + (detail.quantity || 0), 0);
      }
      return 0;
    }


    getStatusText(status: number): string {
      switch (status) {
        case 0:
          return 'Đã đặt hàng';
        case 1:
          return 'Đã giao  cho đơn vị vận chuyển';
        case 2:
          return 'Đang vận chuyển hàng';
        case 7:
          return 'Đã hủy';
        case 3:
            return 'Đang trên đường giao đến bạn';
        case 4:
            return 'Giao hàng thành công';
        case 5:
            return 'Giao hàng thất bại';
        case 6:
            return 'Trả hàng về shop';
        default:
          return 'Trạng thái không xác định';
      }
    }
    getPay(status: number): "Thanh toán VNPAY" | "Thanh toán khi nhận hàng"  {
      if (status == 1) {
        return "Thanh toán VNPAY";
      } else{
        return "Thanh toán khi nhận hàng";
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
