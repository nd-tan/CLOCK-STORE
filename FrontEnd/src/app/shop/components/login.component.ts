import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { User } from '../shop';
import { AuthService } from '../auth.service';
import { SocialUser,SocialAuthService ,FacebookLoginProvider} from '@abacritt/angularx-social-login';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'user-login',
  templateUrl: './../templates/login.component.html',
})
export class LoginComponent implements OnInit {
  loginForm!: FormGroup;
  ChangePassForm!: FormGroup;
  error: any;
  user:any = SocialUser;
  loggedIn:any;
  constructor(
    private _Router: Router,
    private _UserService: AuthService,
    private authService: SocialAuthService,
    ) { }

  ngOnInit(): void {
    this.authService.authState.subscribe((user) => {
      this.user = user;
      this.loggedIn = (user != null);
    });

    if(!this._UserService.checkAuth()){
    this.loginForm = new FormGroup({
      'email':new FormControl('',[
        Validators.required,
        Validators.email,
      ]),
      'password': new FormControl('',[
        Validators.required,
        Validators.minLength(6)
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
  signInWithFB(): void {
    this.authService.signIn(FacebookLoginProvider.PROVIDER_ID);
    console.log(typeof(this.user));
    console.log(this.user);

  }
  signOut(): void {
    this.authService.signOut();
  }
}