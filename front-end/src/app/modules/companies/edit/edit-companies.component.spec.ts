import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EditCompaniesComponent } from './edit-companies.component';

describe('EditComponent', () => {
  let component: EditCompaniesComponent;
  let fixture: ComponentFixture<EditCompaniesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EditCompaniesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EditCompaniesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
