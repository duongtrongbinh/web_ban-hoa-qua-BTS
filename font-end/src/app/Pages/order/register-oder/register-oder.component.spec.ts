import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RegisterOderComponent } from './register-oder.component';

describe('RegisterOderComponent', () => {
  let component: RegisterOderComponent;
  let fixture: ComponentFixture<RegisterOderComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [RegisterOderComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(RegisterOderComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
