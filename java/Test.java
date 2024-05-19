import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.ArrayList;


public class Test{

    public static void main(String[]args){
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
                
                // création des données de la table auteur
                //1e donnee
                ArrayList<String> contenu_da1 = new ArrayList<>();
                contenu_da1.add("Jules Verne");
                contenu_da1.add("08.02.1828");
                contenu_da1.add("24.03.1905");
                contenu_da1.add("Jules Vernes est né à Nantes, il est célèbre pour es romans d'avantures extraordinaires");
                contenu_da1.add("jules_vernes");
                Donnees da1=new Donnees(table_auteur, contenu_da1);
                //2e donnee
                ArrayList<String> contenu_da2 = new ArrayList<>();
                contenu_da2.add("Agatha Christie");
                contenu_da2.add("15.09.1890");
                contenu_da2.add("12.01.1976");
                contenu_da2.add("Ecrivaine britannique renomée et connue pour ses romans policiers, créatrice de Hercule Poireot");
                contenu_da2.add("agatha_christie");
                Donnees da2=new Donnees(table_auteur, contenu_da2);
                // ajout des données à la table
                table_auteur.ajouterDonnees(da1);
                table_auteur.ajouterDonnees(da2);
                


                //Table livre :
                ArrayList <String> col_livre=new ArrayList<String>();
                col_livre.add("titre");
                col_livre.add("resume");
                col_livre.add("annee_parution");
                col_livre.add("genre");
                col_livre.add("image");
                col_livre.add("id_auteur");
                Table table_livre = new Table("livre", 6,col_livre, con);
                /*
                //création des données de la table
                //1e donnee
                ArrayList<String> contenu_dl1 = new ArrayList<>();
                contenu_dl1.add("Vingt mille lieues sous les mers");
                contenu_dl1.add("Le progrsseur Aronnax, son assistant Conseil et le harponneur Ned Land sont capturés par le capitaine Nemo.");
                contenu_dl1.add("1870");
                contenu_dl1.add("Science-fiction");
                contenu_dl1.add("vint_mille_lieues_sous_les_mers"); // image
                contenu_dl1.add("1");
                Donnees dl1=new Donnees(table_livre, contenu_dl1);
                //2e donnee
                ArrayList<String> contenu_dl2 = new ArrayList<>();
                contenu_dl2.add("Le Crime de l'Orient-Express");
                contenu_dl2.add("Hercule Poirot se retrouve à bord de l'Orient-Express, le luxueux train reliant l'Europe de l'Est à l'Ouest.");
                contenu_dl2.add("1934");
                contenu_dl2.add("Roman Policier");
                contenu_dl2.add("le_crime_de_l_orient_-_express"); // image
                contenu_dl2.add("2");
                Donnees dl2=new Donnees(table_livre, contenu_dl2);
                // ajout des données à la table
                table_livre.ajouterDonnees(dl1);
                table_livre.ajouterDonnees(dl2);        
                */        

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
