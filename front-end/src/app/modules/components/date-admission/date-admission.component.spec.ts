import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DateAdmissionComponent } from './date-admission.component';

describe('DateAdmissionComponent', () => {
  let component: DateAdmissionComponent;
  let fixture: ComponentFixture<DateAdmissionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DateAdmissionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DateAdmissionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
