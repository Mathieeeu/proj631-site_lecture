import java.sql.*;
import java.util.ArrayList;

public class InterfaceAdmin_RectoVerso {
	public static void main(String[] args) throws Exception {
		 // connection à la bdd
		 Connection con = null;
		 try {
			 Class.forName("com.mysql.cj.jdbc.Driver");
			 String url = "jdbc:mysql://127.0.0.1/proj631"; 
			 String user = "root"; 
			 String password = ""; 
 
			 con = DriverManager.getConnection(url, user, password);
			 if (con != null) {
				 //Table auteur :
                ArrayList <String> col_auteur=new ArrayList<String>();
                col_auteur.add("nom_prenom_pseudo");
                col_auteur.add("date_naissance");
                col_auteur.add("date_deces");
                col_auteur.add("biographie");
                col_auteur.add("photo");

                Table table_auteur = new Table("auteur", 5,col_auteur, con);

				//Table livre :
                ArrayList <String> col_livre=new ArrayList<String>();
                col_livre.add("titre");
                col_livre.add("resume");
                col_livre.add("annee_parution");
                col_livre.add("genre");
                col_livre.add("image");
                col_livre.add("id_auteur");
                Table table_livre = new Table("livre", 6,col_livre, con);

				// Lancement de l'interface
				InterfaceLibrairie f=new InterfaceLibrairie(con, table_auteur,table_livre);
                f.setVisible(true);

            }
            else{
                System.out.println("Database Connection failed");
            }
        } 
        catch (ClassNotFoundException e) {
            System.err.println("Driver not found: " + e.getMessage());
        } catch (SQLException e) {
            System.err.println("SQL Exception: " + e.getMessage());
        }
	}
}