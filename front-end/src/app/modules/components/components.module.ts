import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {NameComponent} from './name/name.component';
import {DateComponent} from './date/date.component';
import {DescriptionComponent} from './description/description.component';
import {DatetimeComponent} from './datetime/datetime.component';
import {EmailComponent} from './email/email.component';
import {MotherNameComponent} from './mother-name/mother-name.component';
import {DateAdmissionComponent} from './date-admission/date-admission.component';
import {TelephoneComponent} from './telephone/telephone.component';
import {CpfComponent} from './cpf/cpf.component';
import {SalaryComponent} from './salary/salary.component';
import {SelectSyndicateComponent} from './select-syndicate/select-syndicate.component';
import {SelectCompanyComponent} from './select-company/select-company.component';
import {SelectEmployeeComponent} from './select-employee/select-employee.component';
import {SelectTimetableComponent} from './select-timetable/select-timetable.component';
import {MultiSelectEmployeeComponent} from './multi-select-employee/multi-select-employee.component';
import {CnpjComponent} from './cnpj/cnpj.component';
import {AddressComponent} from './address/address.component';


@NgModule({
  declarations: [
    NameComponent,
    DateComponent,
    DescriptionComponent,
    DatetimeComponent,
    EmailComponent,
    MotherNameComponent,
    DateAdmissionComponent,
    TelephoneComponent,
    CpfComponent,
    SalaryComponent,
    SelectSyndicateComponent,
    SelectCompanyComponent,
    SelectEmployeeComponent,
    SelectTimetableComponent,
    MultiSelectEmployeeComponent,
    CnpjComponent,
    AddressComponent
  ],
  imports: [
    CommonModule
  ],
  exports: [NameComponent]
})
export class ComponentsModule {
}
