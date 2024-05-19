import java.sql.*;

public class MysqlDBConnect {
	public static void main(String[] args) throws Exception {
		Class.forName("com.mysql.cj.jdbc.Driver");
		String url = "jdbc:mysql://127.0.0.1"; // remplacer login par votre login
		String user = "root"; // remplacer login par votre login
		String password = ""; // remplacer mdp par votre mdp PhpMyAdmin

		Connection con = DriverManager.getConnection(url, user, password);
		if (con != null) {
			System.out.println("Database Connected successfully");
			//étape 3: créer l'objet statement 
		      Statement stmt = con.createStatement();
		      ResultSet res = stmt.executeQuery("SELECT * FROM capteur");
		      //étape 4: exécuter la requête
		      while(res.next())
		        System.out.println(res.getInt(1)+"  "+res.getString(2)
		        +"  "+res.getString(3));
		      //étape 5: fermer l'objet de connexion
		      con.close();

			         System.out.println("data selected successfully");
		} else {
			System.out.println("Database Connection failed");
		}
	}
}