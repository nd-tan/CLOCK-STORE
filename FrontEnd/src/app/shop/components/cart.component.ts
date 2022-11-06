import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../auth.service';
import { ShopService } from '../shop.service';

@Component({
  selector: 'app-cart',
  templateUrl: './../templates/cart.component.html',
})
export class CartComponent implements OnInit {
    
    listCart: any;
    cartSubtotal: number = 0;
    constructor(
      private _ShopService: ShopService,
      private _AuthService: AuthService,
      private _Router: Router,
      ) { }
      check: any = this._AuthService.checkAuth();
  ngOnInit(): void {
    if(this.check){
      this.getAllCart();
    }
  }
  getAllCart() {
    if(this.check){
    this._ShopService.getAllCart().subscribe(res => {
        this.listCart = res;
        this.cartSubtotal = 0;
        for(let cart of this.listCart){
            this.cartSubtotal += cart.price * cart.quantity;
        }
    });
  }
}
  updateQuantity(id: any, quantity: any){
    if(this.check){
  this._ShopService.updateQuantity(id, quantity).subscribe(res => {
      this.getAllCart();
    });
  }else{
    this._Router.navigate(['/login']);
  }
}
  deleteCart(id: any){
    if(this.check){
  this._ShopService.deleteCart(id).subscribe(res => {
      this.getAllCart();
      });
    }else{
      this._Router.navigate(['/login']);
    }
  }
}
