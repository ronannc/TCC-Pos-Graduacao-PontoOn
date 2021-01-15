import {Component, OnDestroy, OnInit} from '@angular/core';
import {Subject} from 'rxjs';
import {Companies} from '../../../models/companies';
import {HttpClient} from '@angular/common/http';
import {CompaniesService} from '../../../services/companies/companies.service';

@Component({
  selector: 'app-index',
  templateUrl: './index-companies.component.html',
  styleUrls: ['./index-companies.component.scss']
})
export class IndexCompaniesComponent implements OnInit, OnDestroy {

  dtOptions: any = {};
  companies: Companies[];
  dtTrigger: Subject<any> = new Subject<any>();

  constructor(private http: HttpClient, private companiesService: CompaniesService) {
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
    this.companiesService.getCompanies().subscribe(companies => {
      this.companies = (companies as any).data;
      this.dtTrigger.next();
    });
  }

  ngOnDestroy(): void {
    // Do not forget to unsubscribe the event
    this.dtTrigger.unsubscribe();
  }

}
