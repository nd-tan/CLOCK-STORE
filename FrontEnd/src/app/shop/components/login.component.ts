import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { User } from '../shop';
import { AuthService } from '../auth.service';
@Component({
  selector: 'user-login',
  templateUrl: './../templates/login.component.html',
})
export class LoginComponent implements OnInit {
  loginForm!: FormGroup;
  ChangePassForm!: FormGroup;
  error: any;
  constructor(
    private _Router: Router,
    private _UserService: AuthService,
  ) { }

  ngOnInit(): void {
    if(!this._UserService.checkAuth()){
    this.loginForm = new FormGroup({
      'email':new FormControl('',[
        Validators.required,
        Validators.email,
      ]),
      'password': new FormControl('',[
        Validators.required,
        Validators.minLength(5)
      ]),
    });
    this.ChangePassForm = new FormGroup({
      'email':new FormControl('',[
        Validators.required,
        Validators.email,
      ])
    })
  } else {
    this._Router.navigate(['home']);
  }
  }
  onSubmit():void{
    let data = this.loginForm.value;
    let User: User = {
      email:data.email,
      password:data.password,
    }
    this._UserService.login(User).subscribe(res =>{
        localStorage.setItem('access_token', res.access_token);
        this._Router.navigate(['home']);
        alert("Đăng nhập thành công")
    }, err => {
      if(err.status === 401) {
        alert("Đăng nhập không thành công");
      }
      this.error = true;
    });
  }
  Submit():void{
    let data = this.ChangePassForm.value;
    let email = {
      email:data.email,
    }
    this._UserService.changePassByMail(email).subscribe(res =>{
        this._Router.navigate(['/login']);
        alert("Gửi yêu cầu mật khẩu thành công")
    }, err => {
      if(err.status === 401) {
        alert("Gửi yêu cầu mật khẩu không thành công");
      }
      this.error = true;
    });
  }
}