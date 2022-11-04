import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

import { Router } from '@angular/router';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ShopService } from '../shop.service';
import { ProductListComponent } from './product-list.component';
@Component({
  selector: 'app-header',
  templateUrl: '../templates/header.component.html',
})
export class HeaderComponent implements OnInit {
  id:any;
  listCart: any;
  listCate: any;
  listBrand: any;
  constructor(
    private _AuthService: AuthService,
    private _ShopService: ShopService,
    private _Router: Router,
    //  _ProductListComponent: ProductListComponent
    ) { }
  check:any = this._AuthService.checkAuth();
  ngOnInit(): void {
    this.getAllCart();
    this.getBrands();
    this.getCategories();
  }
  logout(){
    this._AuthService.logout();
    this._Router.navigate(['login']);
  }
  getAllCart() {
    this._ShopService.getAllCart().subscribe(res => {
        this.listCart = res;
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
}


