import { Card, CardActions, CardMedia, Typography, Grid, CardContent, Button } from '@mui/material'
import React, {useCallback} from 'react'
import GlobalNavBar from '../GlobalNavBar/GlobalNavBar'
import * as posters from '../../assets/moviePosters/index'
import {useNavigate} from 'react-router-dom';

const HomePage = () => {

    const navigate = useNavigate();
    const handleOnClick = useCallback((Title, Rating, Genre) => navigate('/booking', {state: {title: Title, rating: Rating, genre: Genre}}), [navigate]);


    return (
        // Global Navbar
        // Trailer - Grid
        // Further search functionality - Dropdown?
        // Movies - Grid

        
        <div>
            <GlobalNavBar />
            <Grid container spacing={2}>
                <Grid item xs={7} sx={{ml: '4%'}}>
                    <iframe width="100%" height="500" src="https://www.youtube.com/embed/In8fuzj3gck?autoplay=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </Grid>
                <Grid item xs={4} style={{textAlign: 'center', backgroundColor: '', margin: '100'}}>
                    <h2 style={{textAlign: 'center'}}>{movieTrailer.title}</h2>
                    <Typography variant="body2" color="text.secondary" textAlign={'center'}>
                                    Rated {movieTrailer.rating} | {movieTrailer.genre}
                    </Typography>
                    <body style={{marginTop: '10%', textAlign: 'center'}}>{movieTrailer.description}</body>
                    <h3 style={{marginTop: '20%', textAlign: 'center'}}>Playing Now!</h3>
                    <Button size='small' variant='contained'>Buy Tickets/View Showtimes</Button>
                </Grid>
            </Grid>
            <Grid container direction="row" style={{ height: "250px", paddingTop: "2%" }}
                spacing={{ xs: 2, md: 3 }} columns={{ xs: 4, sm: 8, md: 12 }}
                sx={{ padding: '10%' }}>
                {movies.map((element) => (
                    <Grid xs={2} sm={4} md={4}>
                        <Card>
                            <CardMedia component='img' height='800' image={posters[element.image]} alt="test" />
                            <CardContent>
                                <Typography gutterBottom variant="h5" component="div">
                                    {element.title}
                                </Typography>
                                <Typography variant="body2" color="text.secondary">
                                    Rated {element.rating} | {element.genre}
                                </Typography>
                            </CardContent>
                            <CardActions>
                                <Button size='small' variant='contained' onClick={() => {handleOnClick(element.title, element.rating, element.genre)}}>Buy Tickets/View Showtimes</Button>
                            </CardActions>
                        </Card>
                    </Grid>
                ))}
            </Grid>
        </div>
    )
}


// This should be connected to the database instead
const movies = [
    { title: 'Avatar', rating: 'PG-13', image: 'AvatarPoster', genre: 'Sci-Fi, Adventure' },
    { title: 'Top Gun: Maverick', rating: 'PG-13', image: 'TopGunMaverickPoster', genre: 'Action' },
    { title: 'Avengers', rating: 'PG-13', image: 'AvengersPoster', genre: 'Action, Sci-Fi' }
]

// This should be connected to the database instead
const movieTrailer = {
    title: 'Nope',
    rating: 'R',
    genre: 'Horror, Western',
    buttonLink: 'idk?',
    description: 'The residents of a lonely gulch in inland California bear witness to an uncanny and chilling discovery.'
}

export default HomePage