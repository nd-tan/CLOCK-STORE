import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

import { Router } from '@angular/router';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ShopService } from '../shop.service';
@Component({
  selector: 'app-header',
  templateUrl: '../templates/header.component.html',
})
export class HeaderComponent implements OnInit {
  listCart: any;
  constructor( 
    private _AuthService: AuthService,
    private _ShopService: ShopService,
    private _Router: Router,
    ) { }
  check:any = this._AuthService.checkAuth();
  ngOnInit(): void {
    this.getAllCart();
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
}


 