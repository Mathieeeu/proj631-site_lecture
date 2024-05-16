import javax.swing.*;
import javax.swing.border.Border;

import java.awt.event.*;
import java.util.ArrayList;
import java.awt.*;

public class InterfaceLibrairie extends JFrame {
    final static int HAUTEUR = 500;
    final static int LARGEUR = 700;
    private ArrayList<Table> liste_tables;
    private Table table_selectionnee;
    private JPanel affichage;
    private JComboBox<String> choix_table;

    public InterfaceLibrairie(ArrayList<Table> liste_tables) {
        this.liste_tables=liste_tables;
        this.setSize(LARGEUR, HAUTEUR);
        this.setTitle("Gestion de la librairie");
        // on initialise la table selectionnée automatiquement à la première table de la liste
        this.table_selectionnee=liste_tables.get(0);

        // création du fond
        JPanel fond=new JPanel();
        Color couleur_fond=Color.decode("#fbf2c4");
        fond.setBackground(couleur_fond);
        this.getContentPane().add(fond, BorderLayout.CENTER);

        // création de la zone de selection de la table
        JPanel selection=new JPanel();
        Color couleur_selection=Color.decode("#e5c185");
        selection.setBackground(couleur_selection);

        JTextField texte=new JTextField("Selectionner la table ");
        texte.setPreferredSize(new Dimension(200, 30));
        texte.setBackground(couleur_selection);
        texte.setBorder(null);
        Color couleur_texte=Color.decode("#c7522a");
        texte.setForeground(couleur_texte);
        texte.setEditable(false);
        texte.setFocusable(false);
        selection.add(texte);

        String[] liste_choix=recuperer_tables(liste_tables);
        choix_table=new JComboBox<>(liste_choix);
        choix_table.setForeground(couleur_texte);

        selection.add(choix_table);
        fond.add(selection);

        // création de la zone de boutons d'action
        JPanel actions=new JPanel();
        Color fond_boutons=Color.decode("#74a892");
        Color couleur_boutons=Color.decode("#008585");
        actions.setBackground(fond_boutons);
        JButton ajouter=new JButton("Ajouter");
        ajouter.setForeground(couleur_boutons);
        JButton modifier=new JButton("Modifier");
        modifier.setForeground(couleur_boutons);
        JButton supprimer=new JButton("Supprimer");
        supprimer.setForeground(couleur_boutons);
        actions.add(ajouter);
        actions.add(modifier);
        actions.add(supprimer);
        fond.add(actions);

        // création de la zone d'affichage des données
        affichage=new JPanel();
        affichage.setBackground(couleur_fond);
        affichage.setPreferredSize(new Dimension(640, 380));
        Color couleur_bordure=Color.decode("#c7522a");
        Border border=BorderFactory.createLineBorder(couleur_bordure, 5);
        affichage.setBorder(border);
        fond.add(affichage);

        ArrayList<Donnees> liste_donnees=this.table_selectionnee.getDonnees();
        for (Donnees donnee : liste_donnees) {
            JButton nouvelle_donnee=new JButton("<html>" + String.join("<br>", donnee.getContenu()) + "</html>");
            nouvelle_donnee.setOpaque(false);
            nouvelle_donnee.setContentAreaFilled(false);
            affichage.add(nouvelle_donnee);

        }

        choix_table.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                // Récupérer l'option sélectionnée
                String selection_table = (String) choix_table.getSelectedItem();
                System.out.println("Table sélectionnée : " + selection_table);
                for (Table t : liste_tables) {
                    if (t.getNom().equals(selection_table)) {
                        table_selectionnee = t;
                        mise_a_jour_interface();
                    }
                }
            }
        });
    }

    private String[] recuperer_tables(ArrayList<Table> liste_tables) {
        String[] res=new String[liste_tables.size()];
        for (int i=0; i<liste_tables.size(); i++) {
            res[i]=liste_tables.get(i).getNom();
        }
        return res;
    }

    private void mise_a_jour_interface() {
        System.out.println("Mise à jour de l'interface en cours");
        ArrayList<Donnees> liste_donnees = this.table_selectionnee.getDonnees();
        affichage.removeAll();
        for (Donnees donnee : liste_donnees) {
            JButton nouvelle_donnee = new JButton("<html>" + String.join("<br>", donnee.getContenu()) + "</html>");
            nouvelle_donnee.setOpaque(false);
            nouvelle_donnee.setContentAreaFilled(false);
            affichage.add(nouvelle_donnee);
        }
        // mise à jour de l'affichage
        affichage.revalidate();
        affichage.repaint();
    }
}
