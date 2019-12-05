import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {

    id: string;
    name: string;
    age: number;
    email: string;

  constructor(data:Map) {
      if (data.has("name")) {
          this.name =  data.get("name");
      }
  }

  ngOnInit() {
  }

}
