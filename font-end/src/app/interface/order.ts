export interface Order {
    service_type_id:number;
    from_district_id:number;
    width:number;
    weight:number;
    length:number;
    height:number;
    to_district_id:number;
    to_ward_code:string;
    insurance_value:number;
    coupon:null;

}