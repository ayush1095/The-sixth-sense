package com.tss.welcome;

public class WelcomeTss {
	
	private String Person;

	public String execute() throws Exception {
		
		if(Person.equals("Student")) {
			return "student";
		} else if(Person.equals("Faculty")) {
			return "faculty";
		} else if(Person.equals("Admin")) {
			return "admin";
		}
		
		return "";
	}

	public String getPerson() {
		return Person;
	}
	
	public void setPerson(String Person) {
		this.Person = Person;
	}
}