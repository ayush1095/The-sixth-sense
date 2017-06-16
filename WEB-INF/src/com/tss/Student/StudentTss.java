package com.tss.Student;

// Import required Packages
import java.sql.*;
import java.lang.Exception;

import com.opensymphony.xwork2.ActionSupport;

public class StudentTss extends ActionSupport {
	
	private static final long serialVersionUID = 1L;
	private String Name=null, Email=null, Pass1=null, Pass2=null, Address=null, School=null, Board=null, Adm_No=null, Phone1=null, Phone2=null;
	private long P1 = 0L, P2=0L;
	
	public String execute() throws Exception {
		
		Connection conn = null;
		PreparedStatement stm = null;
		String sql = null;
		
		// JDBC driver name and database URL and table name
		final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
		final String DB_URL = "jdbc:mysql://localhost:3306/thesixthsense";
		final String TABLE_NAME = "student";
			
		// Database credentials
		final String USER = "root";
		final String PASS = "root@123";
   
		try {
			// Register JDBC driver
			Class.forName(JDBC_DRIVER);

			// Open a connection
			conn = DriverManager.getConnection(DB_URL, USER, PASS);
			
			P1 = Long.parseLong(Phone1);
			P2 = Long.parseLong(Phone2);
			
			sql = "INSERT INTO "+TABLE_NAME+"(Name,Email,Pass,School,Board,Adm_No,Address,Phone,Phone2) VALUES(?,?,?,?,?,?,?,?,?)";
			
			// Execute a query
			stm = conn.prepareStatement(sql);
			stm.setString(1, Name);
			stm.setString(2, Email);
			stm.setString(3, Pass1);
			stm.setString(4, School);
			stm.setString(5, Board);
			stm.setString(6, Adm_No);
			stm.setString(7, Address);
			stm.setLong(8, P1);
			stm.setLong(9, P2);
						
			int count = stm.executeUpdate(); /* Using Prepared Statement */
			
			if(count == 1) {
				
				/* Setting the Input Fields to null */
				this.setName(null);
				this.setEmail(null);
				this.setPass1(null);
				this.setPass2(null);
				this.setSchool(null);
				this.setBoard(null);
				this.setAdm_No(null);
				this.setAddress(null);
				this.setPhone1(null);
				this.setPhone2(null);
				
				addActionMessage("You are successfully registered");
				
				return "success";
			}
		
		} catch(SQLException e) {
			//Handle errors for JDBC
			e.printStackTrace();
		} catch(Exception e) {
			//Handle errors for Class.forName
			e.printStackTrace();
		} finally {
			// Clean Environment
			try {
				if(stm != null)
					stm.close();
			} catch(SQLException e) {
				e.printStackTrace();
			} 
			try {
				if(conn != null)
					conn.close();
			} catch(SQLException e) {
				e.printStackTrace();
			}
		}
		return "error";
	}
	
	/* Validating the input values */
	public void validate() {
		
		/* Validating Phone number */
		
		if(!(Phone1.matches("[0-9]+") && Phone1.length() == 10)) {
			// this.addFieldError("Phone1", "Phone number not valid");
			addActionError("Phone number not valid");
		} else if(!(Phone2.matches("[0-9]+") && Phone2.length() == 10)) {
			// this.addFieldError("Phone2", "Phone number not valid");
			addActionError("Phone number not valid");
		} else if(Phone2.equals(Phone1)) {
			// this.addFieldError("Phone2", "Please insert a different phone number");
			addActionError("Phone numbers cannot be same");
		}
		
		/* Validating Password */
		if(Pass1.length() < 8 && Pass2.length() < 8) {
			// this.addFieldError("Pass1","Password must be at least 8 characters long");
			addActionError("Password must be at least 8 characters long");
		} else if(!(Pass1.equals(Pass2))) {
			// this.addFieldError("Pass1","Passwords do not match");
			addActionError("Passwords do not match");
		}
		
		/* Validating Admission Number */
		if(Adm_No.length() != 8) {
			// this.addFieldError("Adm_No","Admission Number should be of 8 digits");
			addActionError("Admission Number should be of 8 digits");
		} else {
			String str = Adm_No.substring(0,3);
			if(!(str.equals("TSS"))) {
				// this.addFieldError("Adm_No","Admission Number should start with: TSS");
				addActionError("Admission Number should start with: TSS");
			}
		}
	}

	/* Getters and Setters for the above declared values */
	public String getName() {
		return Name;
	}
	
	public void setName(String Name) {
		this.Name = Name;
	}
	
	public String getEmail() {
		return Email;
	}
	
	public void setEmail(String Email) {
		this.Email = Email;
	}
	
	public String getPhone1() {
		return Phone1;
	}
	
	public void setPhone1(String Phone1) {
		this.Phone1 = Phone1;
	}
	
	public String getPhone2() {
		return Phone2;
	}
	
	public void setPhone2(String Phone2) {
		this.Phone2 = Phone2;
	}
	
	public String getPass1() {
		return Pass1;
	}
	
	public void setPass1(String Pass1) {
		this.Pass1 = Pass1;
	}
	
	public String getPass2() {
		return Pass2;
	}
	
	public void setPass2(String Pass2) {
		this.Pass2 = Pass2;
	}
	
	public String getAddress() {
		return Address;
	}
	
	public void setAddress(String Address) {
		this.Address = Address;
	}
	
	public String getSchool() {
		return School;
	}
	
	public void setSchool(String School) {
		this.School = School;
	}
	
	public String getBoard() {
		return Board;
	}
	
	public void setBoard(String Board) {
		this.Board = Board;
	}
	
	public String getAdm_No() {
		return Adm_No;
	}
	
	public void setAdm_No(String Adm_No) {
		this.Adm_No = Adm_No;
	}
}