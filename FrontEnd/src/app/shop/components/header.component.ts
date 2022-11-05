import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { ShopService } from '../shop.service';
import { environment } from 'src/environments/environment';
import { Router } from '@angular/router';
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-header',
  templateUrl: '../templates/header.component.html',
})
export class HeaderComponent implements OnInit {
  id:any;
  listCate: any;
  listCart: any;
  listBrand: any;
  listCartByLike: any;
  url: any = environment.url;
  cartSubtotal: number = 0;
  cartSubByLiketotal: number = 0;

  constructor(
    private _AuthService: AuthService,
    private _ShopService: ShopService,
    private _Router: Router,
    ) { }
    ngAfterViewInit(){

    }
  check: any = this._AuthService.checkAuth();
  ngOnInit(): void {
    this.getAllCart();
    this.getAllCartBylike();
    this.getBrands();
    this.getCategories();
  }
  logout() {
    this._AuthService.logout();
    this._Router.navigate(['login']);
  }
  changeCart(){
    this.ngOnInit();
  }


  getAllCart() {
    this._ShopService.getAllCart().subscribe(res => {
      this.listCart = res;
      this.cartSubtotal = 0;
      for (let cart of this.listCart) {
        this.cartSubtotal += cart.price * cart.quantity;
      }
    });
  }

  getBrands(){
    this._ShopService.brand_list().subscribe(res =>{
      this.listBrand = res;
    })
  }

  getCategories(){
    this._ShopService.cate_list().subscribe(res =>{
      this.listCate = res;
    })
  }
  a(id :any){
    this._Router.navigate(['/product-list/cate/'+id]);
  }
  updateQuantity(id: any, quantity: any) {
    this._ShopService.updateQuantity(id, quantity).subscribe(res => {
      this.getAllCart();
    });
  }
  deleteCart(id: any) {
    this._ShopService.deleteCart(id).subscribe(res => {
      this.getAllCart();
    });
  }
  getAllCartBylike() {
    this._ShopService.getAllCartByLike().subscribe(res => {
      this.listCartByLike = res;
      this.cartSubByLiketotal = 0;
      for (let cartlike of this.listCartByLike) {
        this.cartSubByLiketotal += cartlike.price * cartlike.quantity;
      }
    });
  }
  deleteCartByLike(id: any) {
    this._ShopService.deleteCartByLike(id).subscribe(res => {
      this.getAllCartBylike();
    });
  }
  addToCart(id: number) {
    this._ShopService.addToCart(id).subscribe(res => {
      this._ShopService.getAllCart();
      this.ngOnInit();

      alert('Thêm vào giỏ thành công');
    })
  }


}

