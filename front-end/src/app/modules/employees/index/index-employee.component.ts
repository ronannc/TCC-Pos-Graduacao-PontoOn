import {Component, OnDestroy, OnInit} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {EmployeeService} from '../../../services/employee/employee.service';
import {Employee} from '../../../models/employee';
import {Subject} from 'rxjs';

@Component({
  selector: 'app-index-employee',
  templateUrl: './index-employee.component.html',
  styleUrls: ['./index-employee.component.scss']
})
export class IndexEmployeeComponent implements OnDestroy, OnInit {

  dtOptions: any = {};
  employees: Employee[];
  dtTrigger: Subject<any> = new Subject<any>();

  constructor(private http: HttpClient, private employeeService: EmployeeService) {
  }

  ngOnInit(): void {
    this.dtOptions = {
      pagingType: 'full_numbers',
      lengthMenu: [ 10, 25, 50, -1 ],
      language: {
        lengthMenu: 'Mostrando _MENU_ por pagina',
        info: 'Mostrando _PAGE_ de _PAGES_ páginas',
        search: 'Pesquisar',
        paginate: {
          first: 'Primeira',
          last: 'Ultima',
          next: 'Proxima',
          previous: 'Anterior'
        },
      },
      dom: 'Bfrtip',
      buttons: [
        'print',
        'excel',
        'pageLength'
      ]
    };
    this.employeeService.getEmployees().subscribe(employees => {
      this.employees = (employees as any).data;
      this.dtTrigger.next();
    });
  }

  ngOnDestroy(): void {
    // Do not forget to unsubscribe the event
    this.dtTrigger.unsubscribe();
  }
}
