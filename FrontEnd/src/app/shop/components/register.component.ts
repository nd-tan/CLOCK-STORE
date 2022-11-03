import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../auth.service';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { User } from '../shop';
import { Confirm } from '../confirm.component';
@Component({
  selector: 'user-register',
  templateUrl: './../templates/register.component.html',
})
export class RegisterComponent implements OnInit {
  registerForm!: FormGroup;
  constructor(
    private _Router: Router,
    private _AuthService: AuthService,
  ) { }

  ngOnInit(): void {
    this.registerForm = new FormGroup({
      'name':new FormControl('',[
        Validators.required,
      ]),
      'email':new FormControl('',[  
        Validators.required,
        Validators.email,
      ]),
      'phone':new FormControl('',[  
        Validators.required,
        Validators.maxLength(10),
      ]),
      'password': new FormControl('',[
        Validators.required,
        Validators.minLength(5)
      ]),
      'confirmPassword': new FormControl('',[
        Validators.required,
        Validators.minLength(5)
      ]),
    },[Confirm.confirm('password', 'confirmPassword')])
    
  }
  onSubmit():void{

      let data = this.registerForm.value;
      let User: User = {
        name:data.name,
        phone:data.name,
        email:data.email,
        password:data.password,
      }
      this._AuthService.register(User).subscribe(()=>{
        this._Router.navigate(['']);
        alert("Đăng ký Thành Công")
      });
      this._AuthService.login(User).subscribe(res =>{
        localStorage.setItem('access_token', res.access_token);
        this._Router.navigate(['home']);
        alert("Đăng Nhập Thành Công")
      });
  }
}