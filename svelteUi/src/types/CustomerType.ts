interface CustomerType extends ApiEntityType {
	firstName: string;
	lastName: string;
	email: string;
	phone: string;
	dateOfBirth: string;
	addressHome?: CustomerAddressType;
	addressPostal?: CustomerAddressType;
	addressBilling?: CustomerAddressType;
	fullName: string;
}

interface CustomerAddressType {
	building?: string;
	country: string;
	street?: string;
	city?: string;
	postcode?: string;
}
