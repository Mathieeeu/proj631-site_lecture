import java.util.ArrayList;
import java.util.Arrays;

public class Test{

    public static void main(String[]args){
        //Table auteur :
        ArrayList <String> col_auteur=new ArrayList<String>();
        col_auteur.add("nom_prenom_pseudo");
        col_auteur.add("date_naissance");
        col_auteur.add("date_deces");
        col_auteur.add("bibliographie");
        col_auteur.add("photo");
        Table table_auteur = new Table("auteur", 5,col_auteur);
        // création des données de la table auteur
        //1e donnee
        ArrayList<String> contenu_da1 = new ArrayList<>();
        contenu_da1.add("Jules Verne");
        contenu_da1.add("08.02.1828");
        contenu_da1.add("24.03.1905");
        contenu_da1.add("Jules Vernes est né à Nantes, il est célèbre pour es romans d'avantures extraordinaires");
        Donnees da1=new Donnees(table_auteur, contenu_da1);
        //2e donnee
        ArrayList<String> contenu_da2 = new ArrayList<>();
        contenu_da2.add("Agatha Christie");
        contenu_da2.add("15.09.1890");
        contenu_da2.add("12.01.1976");
        contenu_da2.add("Ecrivaine britannique renomée et connue pour ses romans policiers, créatrice de Hercule Poireot");
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
        col_livre.add("auteur");
        Table table_livre = new Table("livre", 6,col_livre);
        //création des données de la table
        //1e donnee
        ArrayList<String> contenu_dl1 = new ArrayList<>();
        contenu_dl1.add("Vingt mille lieues sous les mers");
        contenu_dl1.add("Le progrsseur Aronnax, son assistant Conseil et le harponneur Ned Land sont capturés par le capitaine Nemo.");
        contenu_dl1.add("1870");
        contenu_dl1.add("Science-fiction");
        contenu_dl1.add("Jules Vernes");
        Donnees dl1=new Donnees(table_livre, contenu_dl1);
        //2e donnee
        ArrayList<String> contenu_dl2 = new ArrayList<>();
        contenu_dl2.add("Le Crime de l'Orient-Express");
        contenu_dl2.add("Hercule Poirot se retrouve à bord de l'Orient-Express, le luxueux train reliant l'Europe de l'Est à l'Ouest.");
        contenu_dl2.add("1934");
        contenu_dl2.add("Roman Policier");
        contenu_dl2.add("Agatha Christie");
        Donnees dl2=new Donnees(table_livre, contenu_dl2);
        // ajout des données à la table
        table_livre.ajouterDonnees(dl1);
        table_livre.ajouterDonnees(dl2);



        //Table utilisateur :
        ArrayList <String> col_utilisateur=new ArrayList<String>();
        col_utilisateur.add("pseudo");
        col_utilisateur.add("mot_de_passe");
        col_utilisateur.add("date_inscription");
        Table table_utilisateur = new Table("utilisateur", 3,col_utilisateur);

        


       
        ArrayList<Table> liste_tables = new ArrayList<>();
        liste_tables.add(table_auteur);
        liste_tables.add(table_livre);
        liste_tables.add(table_utilisateur);

        InterfaceLibrairie f=new InterfaceLibrairie(liste_tables);
		f.setVisible(true);
    }
}
