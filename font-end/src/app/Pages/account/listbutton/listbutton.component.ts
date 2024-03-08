import { Component } from '@angular/core';

@Component({
  selector: 'app-listbutton',
  templateUrl: './listbutton.component.html',
  styleUrl: './listbutton.component.css'
})
export class ListbuttonComponent {
  items = [
    { label: 'Đơn hàng', href: '/orders' },
    { label: 'Thông tin cá nhân', href: '/infomation' }
  ];
  activeIndex: number | null = null;

  setActiveIndex(index: number): void {
    this.activeIndex = index;
  }
}
