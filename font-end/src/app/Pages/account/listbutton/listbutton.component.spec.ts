import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListbuttonComponent } from './listbutton.component';

describe('ListbuttonComponent', () => {
  let component: ListbuttonComponent;
  let fixture: ComponentFixture<ListbuttonComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ListbuttonComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ListbuttonComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
