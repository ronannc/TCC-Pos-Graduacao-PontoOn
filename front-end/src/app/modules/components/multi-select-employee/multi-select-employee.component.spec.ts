import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MultiSelectEmployeeComponent } from './multi-select-employee.component';

describe('MultiSelectEmployeeComponent', () => {
  let component: MultiSelectEmployeeComponent;
  let fixture: ComponentFixture<MultiSelectEmployeeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MultiSelectEmployeeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MultiSelectEmployeeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
