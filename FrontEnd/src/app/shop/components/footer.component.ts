import { Component, OnInit } from '@angular/core';
import { ShopService } from '../shop.service';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-footer',
  templateUrl: '../templates/footer.component.html',
})
export class FooterComponent implements OnInit {

  listCart: any;
  url:any = environment.url;
    cartSubtotal: number = 0;
    constructor(private _ShopService: ShopService) { }
  ngOnInit(): void {
    this.getAllCart();
  }
  getAllCart() {
    this._ShopService.getAllCart().subscribe(res => {
        this.listCart = res;
        this.cartSubtotal = 0;
        for(let cart of this.listCart){
            this.cartSubtotal += cart.price * cart.quantity;
        }
    });
}
updateQuantity(id: any, quantity: any){
  this._ShopService.updateQuantity(id, quantity).subscribe(res => {
      this.getAllCart();
  });
}
deleteCart(id: any){
  this._ShopService.deleteCart(id).subscribe(res => {
      this.getAllCart();
  });
}
}
