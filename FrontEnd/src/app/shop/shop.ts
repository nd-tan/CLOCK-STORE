

export interface Product {
  name: any;
  price: any;
  quantity: any;
  sale_price: any;
  image:{ url: string};
  description: any;
}
export interface Category {
  name: any;
}
export interface Register {
  name:any;
  email:any;
  phone:any;
  password: any;
  password_confirmation: any;
}
export interface User {
  id?:any;
  name?:any;
  phone?:any;
  email:any;
  password:any;
}

export interface Brand {
  name: any;
  logo: any;
  status: any;
}